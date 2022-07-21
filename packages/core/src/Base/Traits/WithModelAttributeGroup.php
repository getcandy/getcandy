<?php

namespace GetCandy\Base\Traits;

use GetCandy\Models\AttributeGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Trait WithModelAttributeGroup
 * @package GetCandy\Base\Traits
 *
 * @property Collection $availableGroupOptions
 * @property Collection $availableGroupValueOptions
 */
trait WithModelAttributeGroup
{
    /**
     * Check if the group type is a model.
     * @param  \GetCandy\Models\AttributeGroup  $group
     *
     * @return bool
     */
    protected function isGroupTypeModel(AttributeGroup $group): bool
    {
        return $group->type === 'model';
    }

    /**
     * Get the translated group names.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function getTranslatedGroupNames(): Collection
    {
        return AttributeGroup::whereType('model')
            ->get()
            ->mapWithKeys(
                fn(AttributeGroup $group, $key) => [
                    'model_'.$group->handle => $group->translate('name'),
                ]
            );
    }

    /**
     * Get attribute group from model and override attribures from source.
     * @param  \GetCandy\Models\AttributeGroup  $group
     *
     * @return \GetCandy\Models\AttributeGroup
     */
    protected function getAttributeGroupFromModel(AttributeGroup $group): AttributeGroup
    {
        if (!$group->source) {
            return $group;
        }

        try {
            /** @var \Illuminate\Database\Eloquent\Model $model */
            $model = app($group->source);
            $group->attributes = $model::all();
        } catch (\Exception $e) {
            //dd($e->getMessage());
        }

        return $group;
    }

    /**
     * Get available groups as options.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getAvailableGroupOptionsProperty(): Collection
    {
        /** @var AttributeGroup $group */
        $group = AttributeGroup::whereHandle(
            $handle = Str::replace('model_', '', $this->activeTab)
        )->first();

        if (!$group) {
            return collect();
        }
        $group = $this->getAttributeGroupFromModel($group);
        $productTypeData = $this->productType->attribute_data && $this->productType->attribute_data->has($handle)
            ? collect($this->productType->attribute_data->get($handle))
            : collect();

        return $group->attributes->map(
            fn(Model $option) => [
                'id' => $option->id,
                'name' => $option->translate('name'),
                'disabled' => $productTypeData->keys()->contains($option->id),
            ]);
    }

    /**
     * Get available groups as options.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getAvailableGroupValueOptionsProperty(): Collection
    {
        /** @var AttributeGroup $group */
        $group = AttributeGroup::whereHandle(
            $handle = Str::replace('model_', '', $this->activeTab)
        )->first();

        if (!$group) {
            return collect();
        }
        $group = $this->getAttributeGroupFromModel($group);
        $productTypeData = $this->productType->attribute_data && $this->productType->attribute_data->has($handle)
            ? collect($this->productType->attribute_data->get($handle))
            : collect();

        return $group->attributes->map(
            fn(Model $option) => [
                'id' => $option->id,
                'name' => $option->translate('name'),
                'disabled' => $productTypeData->keys()->contains($option->id),
            ]);
    }

    /**
     * Prepare the attribute model data.
     *
     * @param  \GetCandy\Models\AttributeGroup  $group
     * @param  array  $values
     *
     * @return \Illuminate\Support\Collection
     */
    protected function prepareAttributeModelData(AttributeGroup $group, array $values = []): Collection
    {
        $data = collect($this->productType->attribute_data->get($group->handle));
        if (!$data->has('groupIds')) {
            $data->put('groupIds', []);
        }
        $groupIds = collect($data->get('groupIds'));
        if (!$groupIds->contains($this->selectedGroupId)) {
            $groupIds->push($this->selectedGroupId);
        }
        $data->put('groupIds', $groupIds);
        return $data->put($this->selectedGroupId, ['values' => $values]);
    }

    protected function filterOnlyAssignedGroups(Model $model): bool
    {
        if (!$this->productType->attribute_data) {
            return false;
        }

        $group = AttributeGroup::whereHandle(Str::replace('model_', '', $this->activeTab))->first();
        $data = collect($this->productType->attribute_data->get($group->handle));
        return $data->keys()->contains($model->id);
    }

    protected function sortGroupValues(Model $group, string $handle): Collection
    {
        return $group->values->sortBy(function (Model $groupValue) use ($group, $handle) {
            $groupValuePositions = collect($this->productType->attribute_data->get($handle))->get($group->id)['values'];
            return collect($groupValuePositions)->search($groupValue->id);
        });
    }

    public function detachGroup(): void
    {
        $group = AttributeGroup::whereHandle(Str::replace('model_', '', $this->activeTab))->first();
        $data = collect($this->productType->attribute_data->get($group->handle));
        $groupIds = collect($data->get('groupIds'));
        $data->put('groupIds', $groupIds->filter(fn($id) => $id !== $this->removeGroupId));
        $data->pull($this->removeGroupId);

        $this->productType->attribute_data->put($group->handle, $data);
        $this->productType->save();
        $this->removeGroupId = null;
    }

    protected function attachGroupValue()
    {

    }
}
