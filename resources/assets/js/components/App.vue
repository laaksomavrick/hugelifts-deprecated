<template>
    <div class="app">
        <router-view />
        <confirm-modal />
        <routine-day-exercises-modal />
    </div>
</template>

<script>

import ConfirmModal from './modals/ConfirmModal'
import RoutineDayExercisesModal from './modals/RoutineDayExercisesModal'

export default {

    components: {
        ConfirmModal,
        RoutineDayExercisesModal
    }

}

</script>

<style lang="scss">

.app {
    height: 100vh;
    font-family: sans-serif;
}

</style>
