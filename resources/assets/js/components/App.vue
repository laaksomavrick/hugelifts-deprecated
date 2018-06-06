<template>
    <div class="app">
        <router-view />
        <confirm-modal />
        <routine-day-exercises-modal />
        <routine-days-modal />
    </div>
</template>

<script>

import ConfirmModal from './modals/ConfirmModal'
import RoutineDayExercisesModal from './modals/RoutineDayExercisesModal'
import RoutineDaysModal from './modals/RoutineDaysModal'

export default {

    components: {
        ConfirmModal,
        RoutineDayExercisesModal,
        RoutineDaysModal
    }

}

</script>

<style lang="scss">

.app {
    height: 100vh;
    font-family: sans-serif;
}

</style>
