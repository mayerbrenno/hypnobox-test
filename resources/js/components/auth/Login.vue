<template>
    <div class="auth-container">
      <form @submit.prevent="login" class="auth-form">
        <h2>Login</h2>

        <div class="form-group">
          <label for="email">Email</label>
          <input
            type="email"
            id="email"
            v-model="formData.email"
            required
            :class="{ 'error': errors.email }"
          >
          <div class="error-message" v-if="errors.email">{{ errors.email }}</div>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input
            type="password"
            id="password"
            v-model="formData.password"
            required
            :class="{ 'error': errors.password }"
          >
          <div class="error-message" v-if="errors.password">{{ errors.password }}</div>
        </div>

        <button type="submit" :disabled="loading">
          {{ loading ? 'Logging in...' : 'Login' }}
        </button>

        <div class="auth-links">
          <router-link to="/register">Don't have an account? Register</router-link>
          <router-link to="/forgot-password">Forgot password?</router-link>
        </div>
      </form>
    </div>
  </template>

  <script>
  export default {
    "name": "Login",
    data() {
      return {
        formData: {
          email: '',
          password: ''
        },
        errors: {},
        loading: false
      }
    },
    methods: {
      async login() {
        this.loading = true;
        this.errors = {};

        try {
          const response = await axios.post('/api/login', this.formData);

          // Store the token
          localStorage.setItem('auth_token', response.data.token);

          // Add token to axios defaults
          axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;

          // Redirect to protected route
          this.$router.push({ name: 'dashboard' });
        } catch (error) {
          if (error.response?.data?.errors) {
            this.errors = error.response.data.errors;
          } else {
            this.$toast.error('Login failed. Please try again.');
          }
        } finally {
          this.loading = false;
        }
      }
    }
  }
  </script>

  <style scoped>
  .auth-container {
    max-width: 400px;
    margin: 0 auto;
    padding: 2rem;
  }

  .auth-form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }

  .form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
  }

  .form-group input {
    padding: 0.5rem;
    border: 1px solid #ddd;
    border-radius: 4px;
  }

  .form-group input.error {
    border-color: #ff4444;
  }

  .error-message {
    color: #ff4444;
    font-size: 0.875rem;
  }

  button {
    padding: 0.75rem;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  button:disabled {
    background-color: #cccccc;
    cursor: not-allowed;
  }

  .auth-links {
    display: flex;
    justify-content: space-between;
    margin-top: 1rem;
  }

  .auth-links a {
    color: #007bff;
    text-decoration: none;
  }

  .auth-links a:hover {
    text-decoration: underline;
  }
  </style>
