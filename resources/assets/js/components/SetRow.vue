<template>
    <div class="set-row">
        <div class="set-row__text">
            {{ text }}
        </div>
        <div class="set-row__actions">
            <input
                class="set-row__form-control"
                placeholder="Reps"
                type="number"
                min="1"
                max="12"
                step="1"
                :value="reps"
            >
            </input>
            <input
                class="set-row__form-control"
                placeholder="%"
                type="number"
                min="0"
                max="100"
                step="5"
                :value="percentage"
            >
            </input>
        </div>
    </div>
</template>

<script>

import { mapGetters } from 'vuex'

export default {

    props: {
        set: Object,
        ordinal: Number
    },

    computed: {

        text: function() {
            const ordinal = this.ordinal + 1
            return `Set ${ordinal}.`
        },

        reps: function() {
            return this.set.reps
        },

        percentage: function() {
            return this.set.percentage
        }

    }

}

</script>

<style lang="scss" scoped>

@import '../../sass/bscore';
@import '../../sass/form';

.set-row {
    display: flex;
    align-items: center;

    &__text {

    }

    &__actions {
        margin-left: auto;
        display: flex;
    }

    &__form-control {
        @extend .form-control;
        padding: 2.5px;
        max-width: 80px;
        min-width: 50px;
        margin-left: 5px;
        margin-right: 5px;
        text-align: center;
    }
}

</style>
