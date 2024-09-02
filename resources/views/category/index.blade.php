<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>
<div class="container">

    {{-- dd(session()->all()) 

     <!-- Session to pass the message for the CRUD operations -->
     @session('status')
     <div class="success-message">
         {{ session('status') }}
     </div>
     @endsession
     --}}       
    

 <livewire:category-pagination />
    
 
@push('other-scripts')
<script>
    console.log('TEST JS SCRIPT');  
</script>
@endpush

</div>
</x-app-layout>