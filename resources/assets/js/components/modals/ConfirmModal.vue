<template>
    <modal
        v-if="open"
        :headerText="headerText"
        :onClose="onClose"
        :onDelete="onDelete"
        :working="working"
    >
        {{ bodyText }}
    </modal>
</template>

<script>

import Modal from './Modal'
import { mapGetters, mapActions } from 'vuex'

export default {

    components: {
        Modal
    },

    data: function() {
        return {
            working: false
        }
    },

    methods: {

        onClose: function() {
            return this.toggleConfirmModal({open: false, props: {}})
        },

        onDelete: async function() {
            //TODO handle errors
            this.working = true
            await this.getConfirmModal.props.onDelete()
            this.working = false
            this.onClose()
        },

        ...mapActions([
            'toggleConfirmModal'
        ])
    },

    computed: {

        open: function() {
            return this.getConfirmModal.open
        },
        
        headerText: function() {
            return this.getConfirmModal.props.headerText
        },

        bodyText: function() {
            return this.getConfirmModal.props.bodyText
        },

        ...mapGetters([
            'getConfirmModal'
        ])

    }



}

</script>

