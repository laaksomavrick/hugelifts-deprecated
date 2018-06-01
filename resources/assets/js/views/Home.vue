<template>
    <div class="home">
        <navbar></navbar>
        <router-view></router-view>
    </div>
</template>

<script>

import NavBar from '../components/Navbar'

export default {

    components: {
        'navbar': NavBar
    },

    mounted: function() {


    }

}

</script>

<style>

</style>
