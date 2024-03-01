<template>
  <div class="flex rounded-lg shadow-lg py-4">
    <div class="p-6 flex">
      <div class="flex items-center space-x-4">
        <div class="flex-1">
          <h4 class="text-lg font-semibold text-gray-900">{{ airlineName }}</h4>
          <p class="text-sm text-gray-600">{{ getFormattedTime(flight.departureTime) }} - {{ getFormattedTime(flight.arrivalTime) }} </p>
          <p class="text-xs text-gray-500">{{ flight.departure }} - {{ flight.arrival }}</p>
          <p class="text-xs text-gray-500">Nonstop</p>
        </div>

        <div class="text-right">
          <p class="text-lg font-semibold text-gray-900">${{ flight.priceTotal }}</p>
          <p class="text-sm text-gray-600">{{ getDuration }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">

export default {
    name: 'FlightResult',
    props: {
        flight: {
            type: Object,
            required: true
        }
    },
    computed: {
        formattedDate() {
            return new Date(this.flight.date).toLocaleDateString();
        },
        airlineName() {
            // TODO: Update this to check for airline name
            return this.flight.AirlineCodes[0];
        },
        getDuration() {

            // TODO: There is a bug here with timezones showing length too short

            const start = new Date(this.flight.departureTime);
            const end = new Date(this.flight.arrivalTime);
            const diff = end.getTime() - start.getTime();
            const hours = Math.floor(diff / (1000 * 60 * 60));
            const minutes = Math.floor((diff / (1000 * 60)) % 60);
            return `${hours}h ${minutes}m`;
        }
    },
    methods: {
        getFormattedTime(time: string) {
            return new Date(time).toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
        },

    }
}

</script>