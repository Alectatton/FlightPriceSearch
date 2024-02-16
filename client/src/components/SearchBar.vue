<template>
    <hr />
    <Form @submit.prevent="onSubmit">
        <div class="flex justify-center items-center py-4">
            <div class="flex items-center border-2 border-gray-100 p-1 m-2 space-x-3 bg-white rounded-lg shadow-xl">
                <span class="material-symbols-outlined pl-2 text-gray-400">
                    location_on
                </span>

                <input 
                    placeholder="Leaving From"
                    class="items-center py-1 px-2 rounded-lg focus:outline-none w-40"
                    type="text"
                />
            </div>

            <div class="flex items-center border-2 border-gray-100 p-1 m-2 space-x-3 bg-white rounded-lg shadow-xl">
                <span class="material-symbols-outlined pl-2 text-gray-400">
                    location_on
                </span>

                <input 
                    placeholder="Going To"
                    class="items-center py-1 px-2 rounded-lg focus:outline-none w-40"
                    type="text"
                />
            </div>

            <div class="flex items-center border-2 border-gray-100 p-1 m-2 space-x-3 bg-white rounded-lg shadow-xl">
                <span class="material-symbols-outlined pl-2 text-gray-400">
                    calendar_today
                </span>

                <VueDatePicker 
                    range 
                    :enable-time-picker="false" 
                    :preview-format="null"
                    :min-date="new Date()"
                    no-today> 
                    <template #trigger>
                        <input placeholder="Dates"
                            class="items-center py-1 px-2 rounded-lg focus:outline-none w-40"
                        />
                    </template>
                </VueDatePicker>
            </div>

            <div class="flex items-center border-2 border-gray-100 p-1 m-2 space-x-3 bg-white rounded-lg shadow-xl">
                <span class="material-symbols-outlined pl-2 text-gray-400">
                    person
                </span>

                <input 
                    placeholder="Travelers"
                    class="items-center py-1 px-2 rounded-lg focus:outline-none w-40"
                    type="text"
                />
            </div>

            <button 
                type="submit"
                class="bg-blue-400 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                Search
            </button>
        </div>
    </Form>
    <hr />
</template>
  
<script lang="ts">
import VueDatePicker from '@vuepic/vue-datepicker';
import { defineRule, Form, Field, ErrorMessage } from 'vee-validate';
import { ValidationProvider, extend } from 'vee-validate';
import { required } from '@vee-validate/rules';

export default {
    name: 'SearchBar',
    components: {
        VueDatePicker,
        Form,
        Field,
        ErrorMessage,
    },
    methods: {
        onSubmit() {
            console.log('Form submitted');
        }
    }
}

</script>