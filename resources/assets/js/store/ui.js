const state = {
    confirmModal: {
        open: false,
        props: {}
    }
}

const actions = {

    toggleConfirmModal({ commit }, data) {
        commit('setConfirmModal', data)
    }

}

const mutations = {

    setConfirmModal(state, data) {
        state.confirmModal.open = data.open
        state.confirmModal.props = data.props
    }

}

const getters = {
    getConfirmModal: state => state.confirmModal
}

export default {
    state,
    actions,
    mutations,
    getters
}
