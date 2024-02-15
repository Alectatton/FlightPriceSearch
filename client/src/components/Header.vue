<template>
    <div class="flex justify-between items-center px-8 py-8">
        <Logo/>

        <div class="flex justify-end">

            <div class="text-gray-400 px-4">
                Sign Up
            </div>

            <div class="text-gray-400 px-4">
                Login
            </div>

            
            <span class="material-symbols-outlined px-4 text-gray-400">
                person
            </span>
        </div>
    </div>
</template>
  
<script lang="ts">
import Logo from './Logo.vue'

export default {
    name: 'Header',
    components: {
        Logo,
    },
}  

</script>