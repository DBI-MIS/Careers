@props(['post', 'response'])

    {{-- @livewire('notifications') --}}

    <div class="px-5 py-5 ">
        {{-- <button x-data x-on:click="$dispatch('close-modal')">
            X
        </button> --}}
        @csrf
        <x-filament-actions::modals />
    <form wire:submit="create">
        
        <div>
            <div class="mb-5">
            <span class="text-2xl text-bold text-gray-600">Job Application</span>
            <input type="text" wire:model="post_title" @readonly(true) name="post_title" hidden>
                    <div>
                        @error('post_title') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>

    <table class="w-full">
      
      <tbody>
        <tr>
          <td style="width:25%"><label>Full Name</label></td>
          <td><input type="text" wire:model="full_name" name="full_name" class="!border-none !w-full !mb-4 !rounded-md" autofocus>
            <div>
                @error('full_name') <span class="error">{{ $message }}</span> @enderror 
            </div></td>
        </tr>
        <tr>
          <td><label>Date</label></td>
          <td><input type="text" wire:model="date_response" @readonly(true) name="date_response" class="!border-none !w-full !mb-4">
            <div>
                @error('date_response') <span class="error">{{ $message }}</span> @enderror 
            </div></td>
        </tr>
        <tr>
          <td><label>Contact</label></td>
          <td><input type="text" wire:model="contact" name="contact" class="!border-none !w-full !mb-4">
            <div>
                @error('contact') <span class="error">{{ $message }}</span> @enderror 
            </div></td>
        </tr>
        <tr>
            <td><label>Email</label></td>
            <td><input type="text" wire:model="email_address" name="email_address" class="!border-none !w-full !mb-4">
                <div>
                    @error('email_address') <span class="error">{{ $message }}</span> @enderror 
                </div></td>
        </tr>
        <tr>
            <td>Current Address</td>
            <td><input type="text" wire:model="current_address" name="current_address" class="!border-none !w-full !mb-4">
                <div>
                    @error('current_address') <span class="error">{{ $message }}</span> @enderror 
                </div></td>
        </tr>
        </tbody>
    </table>

            
            
        
            <div class="mt-5">
                <span>Attachment</span>            
                <input type="file" wire:model="attachment" name="attachment" class="!border-none !w-full !mb-4">
        <div wire:loading.delay.long wire:target="attachment">Uploading...</div>
            </div>
    
        
        

        
        {{-- {{ $this->form }} --}}
        

        
        
    
        <div class="float-right">   
        <button 
        
        wire:click=""
        wire:loading.attr="disabled"
        wire:target="attachment"
        wire:confirm="Are you sure you want to submit this application?"
        type="submit" 
        class="mt-3 inline-flex items-center justify-center h-10 px-4 font-medium tracking-wide text-white transition duration-200 bg-blue-900 rounded-lg hover:bg-gray-800 focus:shadow-outline focus:outline-none">
            Submit
        </button>
        </div>
        {{-- @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif --}}

    </div>
        
    </form>

    
    
    </div>
