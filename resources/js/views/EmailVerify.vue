<template>
    <div ref="verify-modal-wrapper">

    </div>
</template>

<script>
    export default {
        props: {
            verifyQuery: {
                type: String,
                default: null
            }
        },
        data() {
            return {
                user: '',
                token: '',
                id: 0,
                hash: '',
                params: []
            }
        },
        mounted() {
            this.email = localStorage.getItem('user');
            this.token = localStorage.getItem('jwt');
            this.token ? this.$store.state.userToken = this.token : this.$store.state.userToken = '';
            this.email ? this.$store.state.loggedInUser = this.user : this.$store.state.userToken = '';

            this.destructQuery();
        },
        methods: {
            destructQuery() {
                let query = this.verifyQuery;
                let userId = '';
                let hash = '';

                query = query.substring(query.indexOf('email/verify'));
                query = query.split('/');

                if (query.length > 2) {
                    userId = query[2];
                    hash = query[3].substring(0, query[3].indexOf('?expires='));
                }

                if (userId != '' && hash != '' && this.token != '') {
                    //make request to backend (confirm email address)
                    let headers = {
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': `Bearer ${this.token}`
                        }
                    };

                    axios.get('/api/user/verify/' + userId + '/' + hash, headers)
                        .then(response => {
                            if (response.data.success)
                            {
                                this.$router.push('/').then(response => {
                                    //this.$store.commit('toggleEmailVerifiedModalVisibleState');
                                });
                            }
                            else
                            {
                                // TODO: Show "please log in" modal
                                this.$router.push('/').then(response => {
                                    this.$store.commit('togglePleaseLoginModalVisibleState');
                                });
                            }
                        })
                        .catch(error => {
                            this.$router.push('/').then(response => {
                                this.$store.commit('toggleLoginPromptVisibleState');
                            });
                        });
                }
                else {
                    // redirect to home and request login
                    this.$router.push('/');
                }
            }
        }
    }
</script>

<style scoped lang="scss">
    @import '~/abstracts/_mixins.scss';

    // label {
    //     font-size: 20px;
    // }

    // .btn {
    //     padding: 0 20px;
    // }

    // .login-modal-wrapper {
    //     width: 78%;
    //     top: 40px;
    //     position: fixed;
    //     z-index: 999;
    //     display: flex;
    //     flex-direction: column;

    //     @media #{$tabletPortrait} {
    //         width: 500px;
    //     }
    // }

    // .login-modal {
    //     background: black;
    //     opacity: 70%;
    //     display: flex;
    //     flex-direction: column;
    // }

    // .title-wrapper {
    //     justify-content: center;
    //     display: flex;
    //     margin: 20px 0 70px;
    // }

    // .input-field-wrapper {
    //     display: flex;
    //     justify-content: space-around;
    //     flex-direction: column;
    //     padding: 0 2.5rem;

    //     @media #{$tabletPortrait} {
    //         flex-direction: row;
    //         padding: 0;
    //     }
    // }

    // .input-field-wrapper-left, .input-field-wrapper-right {
    //     display: flex;
    //     flex-direction: column;
    // }

    // .button-wrapper {
    //     display: flex;
    //     justify-content: space-around;
    //     margin: 20px 0 20px 0;
    // }
</style>
