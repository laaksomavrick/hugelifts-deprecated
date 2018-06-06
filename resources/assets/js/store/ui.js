const state = {
    confirmModal: {
        open: false,
        props: {}
    },
    routineDayExercisesModal: {
        open: false,
        props: {}
    },
    routineDaysModal: {
        open: false,
        props: {}
    }
}

const actions = {

    toggleConfirmModal({ commit }, data) {
        commit('setConfirmModal', data)
    },

    toggleRoutineDayExercisesModal({ commit }, data) {
        commit('setRoutineDayExercisesModal', data)
    },

    toggleRoutineDaysModal({ commit }, data) {
        commit('setRoutineDaysModal', data)
    }

}

const mutations = {

    setConfirmModal(state, data) {
        state.confirmModal.open = data.open
        state.confirmModal.props = data.props
    },

    setRoutineDayExercisesModal(state, data) {
        state.routineDayExercisesModal.open = data.open
        state.routineDayExercisesModal.props = data.props
    },

    setRoutineDaysModal(state, data) {
        state.routineDaysModal.open = data.open
        state.routineDaysModal.props = data.props
    }

}

const getters = {
    getConfirmModal: state => state.confirmModal,
    getRoutineDayExercisesModal: state => state.routineDayExercisesModal,
    getRoutineDaysModal: state => state.routineDaysModal
}

export default {
    state,
    actions,
    mutations,
    getters
}
