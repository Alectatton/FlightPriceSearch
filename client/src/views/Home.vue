<template>
    <div class="flex-col">
        <SearchBar />
        <SearchResults />
    </div>

</template>
  
<script lang="ts">
import SearchBar from '../components/SearchBar.vue'
import SearchResults from '../components/SearchResults.vue'

export default {
    name: 'Home',
    components: {
        SearchBar,
        SearchResults,
    },
}  

</script>