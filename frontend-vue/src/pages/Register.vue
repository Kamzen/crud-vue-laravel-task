<template>
  <div class="card login-form-card">
    <div class="card-body">
      <h5 class="card-title form-title text-center">Register</h5>

      <form>
        <div
          class="alert alert-danger"
          role="alert"
          v-if="errors?.hasOwnProperty('invalid')"
        >
          {{ errors["invalid"] }}
        </div>
        <div class="mb-3">
          <label for="firsname" class="form-label">Firstname</label>
          <input
            type="text"
            class="form-control"
            id="firsname"
            placeholder="Firstname"
            v-model="form.firsname"
            autocomplete="true"
          />
        </div>
        <div class="mb-3">
          <label for="lastname" class="form-label">Lastname</label>
          <input
            type="text"
            class="form-control"
            id="lastname"
            placeholder="Lastname"
            v-model="form.lastname"
            autocomplete="true"
          />
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
          <label for="username" class="form-label">Username</label>
          <input
            type="text"
            class="form-control"
            id="username"
            placeholder="Username"
            v-model="form.username"
            autocomplete="true"
          />
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

        <button type="button" class="btn btn-light" @click="login">
          Register
        </button>

        <div class="text-center">
          <i>Already have account?</i>
          <router-link to="/login" class="btn btn-link btn-reg">Login</router-link>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  // eslint-disable-next-line vue/multi-word-component-names
  name: "Register",
  data() {
    return {
      form: {
        email: "",
        password: "",
      },

      errors: {},
      inValidCredentials: 0,
    };
  },
  methods: {
    async login(e) {
      e.preventDefault();

      try {
        const resp = await axios({
          url: `http://localhost:8000/api/local/auth/login`,
          method: "POST",
          data: this.form,
          headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
          },
          withCredentials: true,
        });

        // set token to local storage

        localStorage.setItem("access-token", resp.data.token);
      } catch (e) {
        e.response.status === 422
          ? (this.errors = { ...e.response.data })
          : (this.errors = { invalid: "Network error for now" });
      }
    },
  },
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
