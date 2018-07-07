<template>
    <div class="home">
        <navbar></navbar>
        <b-container class="home__slot">
            <transition name="fade" mode="out-in">
                <router-view :key="key"></router-view>
            </transition>
        </b-container>
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
</style>
