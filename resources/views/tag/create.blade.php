<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>
    <!-- Full-width fluid until the `md` breakpoint, then lock to container -->
    <div class="md:container md:mx-auto">
        <livewire:create-tag />
    </div>
</x-app-layout>