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

import { mapActions } from 'vuex'

export default {

    components: {
        'navbar': NavBar
    },

    mounted: async function() {
        await this.startup()
    },

    methods: {

        ...mapActions([
            'startup'
        ])

    }

}

</script>

<style lang="scss" scoped>

@import '../../sass/bscore';

.home {

    &__slot {
        @include make-container();
        padding-left: 0;
        padding-right: 0;
    }

}

</style>
