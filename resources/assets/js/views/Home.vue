<template>
    <div class="home">
        <navbar></navbar>
        <div class="home__slot">
            <router-view></router-view>
        </div>
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

<style lang="scss" scoped>

@import '../../sass/bscore';

.home {

    &__slot {
        @include make-container();
    }

}

</style>
