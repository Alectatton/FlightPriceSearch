<template>
  <div class="flex rounded-lg shadow-lg py-4">
    <div class="p-6 flex">
      <div class="flex items-center space-x-4">
        <div class="flex-1">
          <h4 class="text-lg font-semibold text-gray-900">Delta</h4>
          <p class="text-sm text-gray-600">9:15 am - 10:49 am</p>
          <p class="text-xs text-gray-500">SLC - LAX</p>
          <p class="text-xs text-gray-500">Nonstop</p>
        </div>

        <div class="text-right">
          <p class="text-lg font-semibold text-gray-900">$144.00</p>
          <p class="text-sm text-gray-600">1hr 34m</p>
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
        }
    }
}

</script>