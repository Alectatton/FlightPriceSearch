<template>
    <div class="flex justify-center items-center">
        <div 
            v-for="input in inputs"
            :key="input.value"
            class="flex items-center border-2 border-gray-100 p-1 m-2 space-x-2 bg-white rounded-lg shadow-xl">
            <span class="material-symbols-outlined pl-2 text-gray-400">
                {{ input.icon }}
            </span>

            <input 
                :placeholder="input.placeholder"
                class="items-center py-1 px-2 rounded-lg focus:outline-none"
                type="text"
            />
        </div>

        <button class="bg-blue-400 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
            Search
        </button>
    </div>
</template>
  
<script lang="ts">

export default {
    name: 'SearchBar',
    components: {
    },
    data() {
        return {
            inputs: [
                {
                    value: 'departure_location',
                    placeholder: 'Leaving from',
                    icon: 'location_on'
                },
                {
                    value: 'arrival_location',
                    placeholder: 'Going to',
                    icon: 'location_on'
                },
                {
                    value: 'dates',
                    placeholder: 'Dates',
                    icon: 'calendar_today'
                },
                {
                    value: 'travelers',
                    placeholder: 'Travelers',
                    icon: 'person'
                }
            ]
        }
    }
}  

</script>