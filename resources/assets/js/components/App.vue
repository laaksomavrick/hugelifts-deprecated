<template>
    <div class="app">
        <transition name="fade" mode="out-in">
            <router-view />
        </transition>
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

@import '../../sass/transitions';

body {
    margin: 0;
    font-size: 0.9rem;
    font-weight: 400;
    line-height: 1.6;
    color: #555;
    background: #f5f8fa;
    text-align: left;
}

div {
    box-sizing: border-box;
}

.app {
    height: 100vh;
    font-family: sans-serif;
}

</style>
