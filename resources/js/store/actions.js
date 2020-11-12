import Axios from "axios"

export default {
    login({
        commit
    }) {
        Axios.get('/login').then(Response => {
            commit('login', Response.data)
                // console.log(Response)
                // console.log('login success')
        })
    }


    // loadAllSkills({
    //     commit
    // }) {
    //     Axios.get('api/skills').then(Response => {
    //         commit('updateAllSkills', Response.data)
    //         console.log(Response)
    //         console.log('loadAllSkills from actions')
    //     })
    // }
}