<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   @vite(['resources/css/register.css'])

</head>
<body>
   
<div class="form-container">
    <form method="POST" action="{{ route('register') }}">
        @csrf
      <h3>Register Now</h3>
      
      <input required placeholder="Enter your Name" id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"> 
      <x-input-error :messages="$errors->get('name')" class="mt-2" />
      {{-- <input required placeholder="Enter your Year Level" id="year_level" type="text" name="year_level" :value="old('year_level')" required autofocus autocomplete="year_level"> --}}
      <div>
         <select required placeholder="Enter your Year Level" id="year_level" type="text" name="year_level" :value="old('year_level')" required="">
             <option value="">Select Year Level</option>
             <option value="1">1st Year</option>
             <option value="2">2nd Year</option>
             <option value="3">3rd Year</option>
             <option value="4">4th Year</option>
         </select>
     </div> 
      <x-input-error :messages="$errors->get('year_level')" class="mt-2" />
      <input required placeholder="Enter your ID Number" id="id_number" type="text" name="id_number" :value="old('id_number')" required autofocus autocomplete="id_number">   
      <x-input-error :messages="$errors->get('id_number')" class="mt-2" />   
      <input required placeholder="Enter your Email" id="email" type="email" name="email" :value="old('email')" required autocomplete="username">
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
      <input required placeholder="Enter your Password"id="password" type="password" name="password" required autocomplete="new-password">
      <x-input-error :messages="$errors->get('password')" class="mt-2" />
      <input required placeholder="Confirm your Password" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password">
      <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
      <input type="submit" name="submit" value="{{ __('Register Now') }}" class="form-btn">
      <p>Already have an Account? <a href="{{ route('login') }}">login now</a></p>
   </form>

</div>

</body>
</html>