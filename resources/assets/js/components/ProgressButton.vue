<template>
    <button
        @click="handleClick"
    >
        <template v-if="working">
            <font-awesome-icon :icon="icon" spin />
        </template>
        <template v-else>
            {{ buttonText }}
        </template>
    </button>
</template>

<script>

import FontAwesomeIcon from '@fortawesome/vue-fontawesome'
import faSpinner from '@fortawesome/fontawesome-free-solid/faSpinner'

export default {

    props: {
        handleClick: Function,
        working: Boolean,
        buttonText: String
    },

    components: {
        FontAwesomeIcon
    },

    computed: {
        icon: function() {
            return faSpinner
        }
    }

}

</script>

<style lang="scss" scoped>

</style>
