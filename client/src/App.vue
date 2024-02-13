<template>
    <Header />

    <routerView />

    <Footer />
</template>

<script lang="ts">
import Header from './components/Header.vue'
import Footer from './components/Footer.vue'

export default {
    name: 'app',
    components: {
        Header,
        Footer
    }
}
</script>
