<template>
    <div class="set-row">
        <div class="set-row__text">
            {{ text }}
        </div>
        <div class="set-row__actions">
            <input
                class="set-row__form-control"
                type="number"
                min="1"
                max="12"
                step="1"
                v-model="reps"
                @keyup="handleChange"
            >
            </input>
            <input
                class="set-row__form-control"
                type="number"
                min="0"
                max="100"
                step="5"
                v-model="percentage"
                @keyup="handleChange"
            >
            </input>
            <button @click="handleRemove" class="set-row__delete">
                <font-awesome-icon :icon="times" />
            </button>
        </div>
    </div>
</template>

<script>

import FontAwesomeIcon from '@fortawesome/vue-fontawesome'
import faTimes from '@fortawesome/fontawesome-free-solid/faTimes'
import { mapGetters } from 'vuex'

export default {

    props: {
        set: Object,
        ordinal: Number,
        onChange: Function,
        onRemove: Function
    },

    components: {
        FontAwesomeIcon
    },

    data: function() {
        return {
            reps: this.set.reps,
            percentage: this.set.percentage
        }
    },

    methods: {
        
        handleChange: function(e) {
            const reps = parseInt(this.reps)
            const percentage = parseInt(this.percentage)
            const set = { ...this.set, reps, percentage }
            this.onChange(set)
        },

        handleRemove: function() {
            this.onRemove(this.set)
        }

    },

    computed: {

        text: function() {
            const ordinal = this.ordinal + 1
            return `Set ${ordinal}.`
        },

        times: function() {
            return faTimes
        }

    }

}

</script>

<style lang="scss" scoped>

@import '../../sass/bscore';
@import '../../sass/form';
@import '~bootstrap/scss/buttons';

.set-row {
    display: flex;
    align-items: center;

    &__text {
        width: 55px;
        text-align: center;
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

    &__delete {
        @extend .btn;
        @extend .btn-danger;
    }
}

</style>
