<template>
  <div class="card login-form-card">
    <div class="card-body">
      <h5 class="card-title form-title text-center">Login {{ isLoggedIn }}</h5>
      <form>
        <div
          class="alert alert-danger"
          role="alert"
          v-if="errors?.hasOwnProperty('invalid')"
        >
          {{ errors["invalid"] }}
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input
            type="email"
            class="form-control"
            id="email"
            placeholder="name@example.com"
            v-model="form.email"
            autocomplete="true"
          />
          <p
            class="text text-danger"
            v-if="
              errors.hasOwnProperty('validates') &&
              errors?.validates.hasOwnProperty('email')
            "
          >
            {{ errors.validates.email[0] }}&#42;
          </p>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input
            type="password"
            class="form-control"
            id="password"
            placeholder="**********"
            v-model="form.password"
            autocomplete="false"
          />
          <p
            class="text text-danger"
            v-if="
              errors.hasOwnProperty('validates') &&
              errors?.validates.hasOwnProperty('password')
            "
          >
            {{ errors.validates.password[0] }}&#42;
          </p>
        </div>

        <button type="button" class="btn btn-light" @click="login(form)">
          Login
        </button>

        <div class="text-center">
          <i>Don't have account?</i>
          <router-link to="/register" class="btn btn-link btn-reg"
            >Register</router-link
          >
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { mapActions, mapState } from "vuex";

export default {
  // eslint-disable-next-line vue/multi-word-component-names
  name: "Login",
  data() {
    return {
      form: {
        email: "",
        password: "",
      },
    };
  },
  mounted() {
    
  },
  created(){

    this.$nextTick(() => {
        this.$store.state.auth.isLoggedIn && this.$router.push({name : 'home'})
    })

  },
  computed: {
    ...mapState("auth", ["userInfo", "errors", "isLoggedIn"]),
  },
  methods: {
    ...mapActions("auth", ["login"]),
  },

  // eslint-disable-next-line no-unused-vars
  beforeRouteEnter(_to,_from, _next){
    _next(vm => {
        localStorage.getItem('access-token') && vm.$router.push({name : 'home'})
    })
  }

};
</script>

<style lang="scss">
.login-form-card {
  width: 30%;
  margin: 20px auto 0 auto;

  .card-body {
    form {
      width: 100%;

      button {
        width: 100%;
      }
      .btn-reg {
        text-decoration: none;
      }
    }
  }
}
</style>
