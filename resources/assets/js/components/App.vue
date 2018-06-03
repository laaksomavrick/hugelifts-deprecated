<template>
    <div class="app">
        <router-view></router-view>

        <!-- move to it's own component -->
        <modal 
            v-if="getConfirmModalOpen"
            headerText="Confirm deletion"
            bodyText="Are you sure you want to delete this?"
        />
    </div>
</template>

<script>

import Modal from './modals/Modal'
import { mapGetters, mapActions } from 'vuex'

export default {

    components: {
        Modal
    },

    computed: {
       ...mapGetters([
            'getConfirmModalOpen'
       ])
    }

}

</script>

<style lang="scss">

.app {
    height: 100vh;
}

</style>
