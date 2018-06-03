const state = {
    confirmModalOpen: false
}

const actions = {

    toggleConfirmModal({ commit }, data) {
        commit('setConfirmModal', data)
    }

}

const mutations = {

    setConfirmModal(state, value) {
        state.confirmModalOpen = value
    }

}

const getters = {
    getConfirmModalOpen: state => state.confirmModalOpen
}

export default {
    state,
    actions,
    mutations,
    getters
}
