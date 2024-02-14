<template>
    <div class="flex-col">
        <SearchBar />
        <HomePageHero />
    </div>

</template>
  
<script lang="ts">
import SearchBar from '../components/SearchBar.vue'
import HomePageHero from '../components/HomePageHero.vue'

export default {
    name: 'Home',
    components: {
        SearchBar,
        HomePageHero,
    },
}  

</script>