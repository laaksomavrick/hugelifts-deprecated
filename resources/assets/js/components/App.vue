<template>
    <div class="app">
        <router-view />
        <confirm-modal />
    </div>
</template>

<script>

import ConfirmModal from './modals/ConfirmModal'

export default {

    components: {
        ConfirmModal
    }

}

</script>

<style lang="scss">

.app {
    height: 100vh;
    font-family: sans-serif;
}

</style>
