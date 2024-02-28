<template>
    <div>
        Flight {{  flight.id }}: for {{ flight.price.total }}
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