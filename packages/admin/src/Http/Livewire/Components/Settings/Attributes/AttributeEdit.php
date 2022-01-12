<?php

namespace GetCandy\Hub\Http\Livewire\Components\Settings\Attributes;

use GetCandy\Facades\FieldTypeManifest;
use GetCandy\Hub\Http\Livewire\Traits\Notifies;
use GetCandy\Hub\Http\Livewire\Traits\WithLanguages;
use GetCandy\Models\Attribute;
use GetCandy\Models\AttributeGroup;
use Illuminate\Support\Str;
use Livewire\Component;

class AttributeEdit extends Component
{
    use WithLanguages, Notifies;

    /**
     * The attribute group.
     *
     * @var string
     */
    public AttributeGroup $group;

    /**
     * The attribute instance.
     *
     * @var \GetCandy\Models\Attribute
     */
    public ?Attribute $attribute = null;

    public function mount()
    {
        $this->attribute = $this->attribute ?: new Attribute([
            'searchable' => true,
            'filterable' => false,
            'required' => false,
            'section' => 'main',
            'system' => false,
            'type' => get_class($this->fieldTypes->first()),
        ]);

    }

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        $rules = [
            "attribute.name.{$this->defaultLanguage->code}" => 'required|string|max:255',
            'attribute.handle' => 'required',
            'attribute.required' => 'nullable|boolean',
            'attribute.searchable' => 'nullable|boolean',
            'attribute.filterable' => 'nullable|boolean',
            'attribute.configuration' => 'nullable|array',
            'attribute.section' => 'string',
            'attribute.system' => 'boolean',
            'attribute.type' => 'required',
        ];

        if ($this->getFieldType()) {
            $fieldTypeOptions = $this->getFieldTypeConfig()['options'] ?? [];

            foreach ($fieldTypeOptions as $field => $validation) {
                $rules["attribute.configuration.{$field}"] = $validation;
            }
        }

        return $rules;
    }

    /**
     * Return the available field types.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getFieldTypesProperty()
    {
        return FieldTypeManifest::getTypes();
    }

    /**
     * Return the selected field type.
     *
     * @return
     */
    public function getFieldType()
    {
        return app()->make($this->attribute->type);
    }

    /**
     * Return the config for the field type.
     *
     * @return void
     */
    public function getFieldTypeConfig()
    {
        return $this->getFieldType()?->getConfig() ?: null;
    }

    public function save()
    {
        $this->validate();

        if (!$this->attribute->id) {
            $this->attribute->attribute_type = $this->group->attributable_type;
            $this->attribute->attribute_group_id = $this->group->id;
            $this->attribute->position = Attribute::whereAttributeGroupId(
                $this->group->id
            )->count() + 1;
            $this->attribute->save();
            $this->notify(
                __('adminhub::notifications.attribute-edit.created')
            );
            $this->emit('attribute-edit.created', $this->attribute->id);
            return;
        }

        $this->attribute->save();

        $this->notify(
            __('adminhub::notifications.attribute-edit.updated')
        );
        $this->emit('attribute-edit.updated', $this->attribute->id);
    }

    /**
     * Render the livewire component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('adminhub::livewire.components.settings.attributes.attribute-edit')
            ->layout('adminhub::layouts.base');
    }
}
