@props(['post', 'response'])

    {{-- @livewire('notifications') --}}

    <div class="px-5 py-5 ">
        {{-- <button x-data x-on:click="$dispatch('close-modal')">
            X
        </button> --}}
        @csrf
        <x-filament-actions::modals />
    <form wire:submit="create" wire:confirm="Are you sure you want to submit this application?" enctype="multipart/form-data">
        <div wire:loading.delay.long wire:target="submit">Sending Application...</div>
        
        
        <div>
            <div class="mb-5">
            <span class="text-2xl text-bold text-gray-600">Job Application</span>
            <input type="text" wire:model="post_title" @readonly(true) name="post_title" hidden>
                    <div>
                        @error('post_title') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>
                

    {{-- <table class="w-full">
      
      <tbody>
        <tr>
          <td style="width:25%"><label>Date</label></td>
          <td><input type="text" wire:model="date_response" @readonly(true) name="date_response" class="!border-none !w-full !mb-4 ">
            <div>
                @error('date_response') <span class="error">{{ $message }}</span> @enderror 
            </div></td>
        </tr>
        <tr>
          <td><label>Full Name</label></td>
         
            <td>
                
                <div>
                    @error('full_name') <span class="error text-red-600 text-sm">{{ $message }}</span> @enderror 
                </div>
                <input type="text" wire:model.change="full_name" name="full_name" class="!w-full !mb-4 !rounded-md border-blue-100" autofocus>
                </td>
        </tr>
        <tr>
          <td><label>Contact</label></td>
          <td>
            <div>
                @error('contact') <span class="error text-red-600 text-sm">{{ $message }}</span> @enderror 
            </div>
            <input type="text" wire:model.change="contact" name="contact" class="!w-full !mb-4 !rounded-md border-blue-100">
            </td>
        </tr>
        <tr>
            <td><label>Email</label></td>
            <td>
                <div>
                    @error('email_address') <span class="error text-red-600 text-sm">{{ $message }}</span> @enderror 
                </div>
                <input type="text" wire:model.change="email_address" name="email_address" class="!w-full !mb-4 !rounded-md border-blue-100">
                </td>
        </tr>
        <tr>
            <td>Current Address</td>
            <td>
                <div>
                    @error('current_address') <span class="error text-red-600 text-sm">{{ $message }}</span> @enderror 
                </div>
                <input type="text" wire:model.change="current_address" name="current_address" class="!w-full !mb-4 !rounded-md border-blue-100">
                </td>
        </tr>
        </tbody>
    </table>

            
            
        
            <div class="mt-5 flex gap-5">
                <span>Attachment</span>
                            
                <input type="file" wire:model.change="attachment" name="attachment" class="!w-full !mb-4 border-blue-100">
        <div wire:loading.delay.long wire:target="attachment">Uploading...</div>
        
            </div>
            <div>
                @error('attachment') <span class="error text-red-600 text-sm">{{ $message }}</span> @enderror 
            </div>
    
        
         --}}

        {{-- @if() --}}
        {{ $this->form }}
        {{-- @endif --}}

        
        
    
        <div class="float-right">   
        <button 
        
        wire:loading.attr="disabled"
        type="submit" 
        class="mt-3 inline-flex items-center justify-center h-10 px-4 font-medium tracking-wide text-white transition duration-200 bg-blue-900 rounded-lg hover:bg-gray-800 focus:shadow-outline focus:outline-none">
            Submit
        </button>
        </div>

    </div>
        
    </form>

    
    
    </div>
