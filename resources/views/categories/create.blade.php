<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('categories.store') }}" class="space-y-6">
                        @csrf

                        <div class="space-y-4">
                            <!-- Name -->
                            <div>
                                <x-filament::input.wrapper>
                                    <x-filament::input.label for="name" value="{{ __('Name') }}" />
                                    <x-filament::input 
                                        id="name"
                                        type="text"
                                        name="name"
                                        :value="old('name')"
                                        required
                                        autofocus
                                        class="block w-full"
                                    />
                                    <x-filament::input.error :messages="$errors->get('name')" />
                                </x-filament::input.wrapper>
                            </div>

                            <!-- Description -->
                            <div>
                                <x-filament::input.wrapper>
                                    <x-filament::input.label for="description" value="{{ __('Description') }}" />
                                    <x-filament::textarea
                                        id="description"
                                        name="description"
                                        rows="4"
                                        class="block w-full"
                                    >{{ old('description') }}</x-filament::textarea>
                                    <x-filament::input.error :messages="$errors->get('description')" />
                                </x-filament::input.wrapper>
                            </div>

                            <!-- Parent Category -->
                            <div>
                                <x-filament::input.wrapper>
                                    <x-filament::input.label for="parent_id" value="{{ __('Parent Category') }}" />
                                    <x-filament::select
                                        id="parent_id"
                                        name="parent_id"
                                        :options="$categories"
                                        class="block w-full"
                                    />
                                    <x-filament::input.error :messages="$errors->get('parent_id')" />
                                </x-filament::input.wrapper>
                            </div>

                            <!-- Status -->
                            <div>
                                <x-filament::input.wrapper>
                                    <div class="flex items-center">
                                        <x-filament::checkbox
                                            id="status"
                                            name="status"
                                            :checked="old('status', true)"
                                        />
                                        <x-filament::input.label for="status" value="{{ __('Active') }}" class="ml-2" />
                                    </div>
                                    <x-filament::input.error :messages="$errors->get('status')" />
                                </x-filament::input.wrapper>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <x-filament::button type="submit">
                                {{ __('Create Category') }}
                            </x-filament::button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
