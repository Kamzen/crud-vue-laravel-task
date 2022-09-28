<template>
  <div class="card login-form-card">
    <div class="card-body">
      <h5 class="card-title form-title text-center">Register</h5>

      <div
        class="alert alert-success"
        role="alert"
        v-if="registerSuccess && registerSuccess !== null"
      >
        Account registered successfully
      </div>

      <form>
        <div
          class="alert alert-danger"
          role="alert"
          v-if="registerErrors?.hasOwnProperty('invalid')"
        >
          {{ registerErrors["invalid"] }}
        </div>
        <div class="mb-3">
          <label for="firstname" class="form-label">Firstname</label>
          <input
            type="text"
            class="form-control"
            id="firsname"
            placeholder="Firstname"
            v-model="form.firstname"
            autocomplete="true"
          />

          <p
            class="text text-danger"
            v-if="
              registerErrors.hasOwnProperty('validates') &&
              registerErrors?.validates?.hasOwnProperty('firstname')
            "
          >
            {{ registerErrors.validates.firstname[0] }}&#42;
          </p>
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

          <p
            class="text text-danger"
            v-if="
              registerErrors.hasOwnProperty('validates') &&
              registerErrors?.validates?.hasOwnProperty('lastname')
            "
          >
            {{ registerErrors.validates.lastname[0] }}&#42;
          </p>
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
              registerErrors?.hasOwnProperty('validates') &&
              registerErrors?.validates.hasOwnProperty('email')
            "
          >
            {{ registerErrors?.validates.email[0] }}&#42;
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

          <p
            class="text text-danger"
            v-if="
              registerErrors.hasOwnProperty('validates') &&
              registerErrors?.validates?.hasOwnProperty('username')
            "
          >
            {{ registerErrors.validates.username[0] }}&#42;
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
              registerErrors.hasOwnProperty('validates') &&
              registerErrors?.validates?.hasOwnProperty('password')
            "
          >
            {{ registerErrors.validates.password[0] }}&#42;
          </p>
        </div>

        <button type="button" class="btn btn-light" @click="signUp">
          Register
        </button>

        <div class="text-center">
          <i>Already have account?</i>
          <router-link to="/login" class="btn btn-link btn-reg"
            >Login</router-link
          >
        </div>
      </form>
    </div>
  </div>
</template>

<script>
// eslint-disable-next-line no-unused-vars
import axios from "axios";
import { mapActions, mapState } from "vuex";

export default {
  // eslint-disable-next-line vue/multi-word-component-names
  name: "Register",
  data() {
    return {
      form: {
        username: "",
        email: "",
        firstname: "",
        lastname: "",
        password: "",
      },
    };
  },
  computed: {
    ...mapState("auth", ["registerErrors", "registerSuccess"]),
  },
  methods: {
    ...mapActions("auth", ["register"]),
    signUp() {
      this.register(this.form);
      // console.log(this.registerErrors);
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
