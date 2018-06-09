<template>
    <div class="home">
        <navbar></navbar>
        <div class="home__slot">
            <transition name="fade" mode="out-in">
                <router-view :key="key"></router-view>
            </transition>
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

    },

    computed: {

        key: function() {
            return this.$route.name
        }

    }

}

</script>

<style lang="scss" scoped>

@import '../../sass/bscore';
@import '../../sass/transitions';

.home {

    height: 100vh;

    &__slot {
        @include make-container();
        padding-left: 0;
        padding-right: 0;
    }

}

</style>
