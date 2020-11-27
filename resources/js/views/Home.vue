<template>
    <div class="wrapper">
        <div class="home-bg" :style="bgStyles">
            <div class="control-panel-wrapper">
                <button
                    class="btn btn-outline-dark py-0"
                    v-if="!isLoggedIn && !loginModalVisible"
                    @click="showLoginModal()"
                    >LOGIN
                </button>

                <h4
                    class="user-name d-inline-block"
                    v-if="isLoggedIn"
                >
                    {{ userName }}
                </h4>

                <button
                    class="btn btn-outline-dark py-0"
                    v-if="isLoggedIn"
                    @click="logout()"
                    >LOGOUT
                </button>
            </div>

            <div class="dashboard-wrapper">
                <Dashboard
                    v-if="isLoggedIn"
                />
            </div>
        </div>
    </div>
</template>

<script>
    import Dashboard from '@/components/Dashboard';

    export default {
        components: {
            Dashboard
        },
        methods: {
            showLoginModal() {
                this.$store.commit('toggleLoginModalVisibleState');
                this.$store.commit('toggleLoginBtnVisibleState');

                if (this.$store.state.registerModalVisible)
                {
                    this.$store.commit('toggleRegisterModalVisibleState');
                }
            },
            logout() {
                this.$store.dispatch('logout');
            }
        },
        computed: {
            btnLoginVisible() {
                return this.$store.state.loginBtnVisible
            },
            btnLogoutVisible() {
                return this.$store.state.logoutBtnVisible
            },
            isLoggedIn() {
                return this.$store.state.isLoggedIn
            },
            userName() {
                if (this.$store.state.loggedInUser)
                {
                    return this.$store.state.loggedInUser
                }

                return this.$store.state.loggedInUser;
            },
            loginModalVisible() {
                return this.$store.state.loginModalVisible;
            },
            bgStyles() {
                return {
                    'background-image': 'url(' + this.$store.state.userBGImage + ')',
                    'height': '100vh',
                    'width': '100%',
                    'background-size': 'cover',
                    'background-attachment': 'fixed',
                    'background-position': 'top',
                    'background-repeat': 'no-repeat',
                    'padding': '12px 50px'
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
    // .home-bg {
    //     background-image: url('/images/default_bg_image.jpg');
    //     height: 100vh;
    //     width: 100%;
    //     background-size: cover;
    //     background-attachment: fixed;
    //     background-position: top;
    //     background-repeat: no-repeat;
    //     padding: 12px 50px;
    // }
</style>
