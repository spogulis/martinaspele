<template>
    <div class="wrapper">
        <div class="header-bg">
            <button
                class="btn btn-outline-dark py-0"
                v-if="btnLoginVisible"
                @click="showLoginModal()"
                >LOGIN</button>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            showLoginModal() {
                this.$store.commit('toggleLoginModalVisibleState');
                this.$store.commit('toggleLoginBtnVisibleState');
            }
        },
        computed: {
            btnLoginVisible() {
                return this.$store.state.loginBtnVisible
            }
        }
    }
</script>

<style lang="scss" scoped>
    .header-bg {
        background-image: url('/images/header_bg.jpg');
        height: 100vh;
        width: 100%;
        background-size: cover;
        background-attachment: fixed;
        background-position: top;
        background-repeat: no-repeat;
        padding: 12px 50px;
    }
</style>
