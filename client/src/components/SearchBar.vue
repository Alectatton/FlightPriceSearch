<template>
    <hr />
        <div class="flex justify-center items-center py-4">
                <div class="flex items-center border-2 border-gray-100 p-1 m-2 space-x-3 bg-white rounded-lg shadow-xl">
                    <span class="material-symbols-outlined pl-2 text-gray-400">
                        location_on
                    </span>

                    <input 
                        v-model="leaving_from"
                        placeholder="Leaving From"
                        class="items-center py-1 px-2 rounded-lg focus:outline-none w-50"
                        type="text"
                    />
                </div>

                <div class="flex items-center border-2 border-gray-100 p-1 m-2 space-x-3 bg-white rounded-lg shadow-xl">
                    <span class="material-symbols-outlined pl-2 text-gray-400">
                        location_on
                    </span>

                    <input
                        v-model="going_to"
                        placeholder="Going To"
                        class="items-center py-1 px-2 rounded-lg focus:outline-none w-50"
                        type="text"
                    />
                </div>

                <div class="flex items-center border-2 border-gray-100 p-1 m-2 space-x-3 bg-white rounded-lg shadow-xl">
                    <span class="material-symbols-outlined pl-2 text-gray-400">
                        calendar_today
                    </span>

                    <VueDatePicker
                        v-model="date_range"
                        range 
                        :enable-time-picker="false" 
                        :preview-format="null"
                        :min-date="new Date()"
                        no-today> 
                        <template #trigger>
                            <input :placeholder="date_range ? date_range : 'dates'"
                                class="items-center py-1 px-2 rounded-lg focus:outline-none w-50"
                            />
                        </template>
                    </VueDatePicker>
                </div>

            <div class="flex items-center border-2 border-gray-100 p-1 m-2 space-x-3 bg-white rounded-lg shadow-xl">
                <span class="material-symbols-outlined pl-2 text-gray-400">
                    person
                </span>

                <input 
                    v-model="travelers"
                    placeholder="Number of Travelers"
                    class="items-center py-1 px-2 rounded-lg focus:outline-none w-50"
                    type="text"
                />
            </div>

            <button 
                type="submit"
                @click.prevent="onSubmit"
                class="bg-blue-400 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                Search
            </button>
        </div>
    <hr />
</template>
  
<script lang="ts">
import VueDatePicker from '@vuepic/vue-datepicker';
import { useVuelidate } from '@vuelidate/core';
import { required, integer, minValue } from '@vuelidate/validators';
import { mapActions } from 'pinia';
import { useFlightStore } from '../stores/flight';

export default {
    name: 'SearchBar',
    setup () {
        return { v$: useVuelidate()}
    },
    components: {
        VueDatePicker,
    },
    methods: {
        ...mapActions(useFlightStore, [
            'fetchFlights',
        ]),
        async onSubmit() {
            const isValid = await this.v$.$validate();

            if (!isValid) {
                console.log('Form is invalid');
                return;
            }

            this.fetchFlights({
                leaving_from: this.leaving_from,
                going_to: this.going_to,
                date_range: this.date_range,
                travelers: this.travelers
            });
        }
    },
    computed: {

    },
    data () {
        return {
            leaving_from: '',
            going_to: '',
            date_range: [],
            travelers: ''
        }
    },
    validations () {
        return {
            leaving_from: {
                required
            },
            going_to: {
                required
            },
            date_range: {
                required
            },
            travelers: {
                required,
                integer,
                minValue: minValue(1)
            }
        }
    }
}

</script>