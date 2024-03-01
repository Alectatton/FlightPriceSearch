<template>
    <div class="flex justify-center">
        <div v-if="!flightStore.loading && flightStore.flights.length === 0" 
            class="flex align-center justify-center py-5">
            <img 
                src="../assets/landscape.jpg" 
                class="flex w-3/4 justify-center align-middle rounded-xl shadow-xl"
            />
        </div>

        <div v-else-if="flightStore.loading"
            class="flex justify-center items-center py-4">
            <div class="flex items">
                Loading
            </div>
        </div>

        <div v-else class="justify-center items-center py-6 w-1/2">
            <FlightResult 
                class=""
                v-for="flight in flightStore.flights" 
                :key="flight.id" 
                :flight="flight">
            </FlightResult>
        </div>
    </div>
</template>
  
<script lang="ts">
import { mapStores } from 'pinia';
import { useFlightStore } from '../stores/flight';
import FlightResult from './FlightResult.vue';

export default {
    name: 'SearchResults',
    components: {
        FlightResult
    },
    computed: {
        ...mapStores(useFlightStore)
    },

}  

</script>