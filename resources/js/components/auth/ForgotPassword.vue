<!-- src/components/auth/ForgotPassword.vue -->
<template>
    <div class="auth-container">
      <form @submit.prevent="sendResetLink" class="auth-form">
        <h2>Forgot Password</h2>

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

        <button type="submit" :disabled="loading">
          {{ loading ? 'Sending...' : 'Send Reset Link' }}
        </button>

        <div class="auth-links">
          <router-link to="/login">Back to Login</router-link>
        </div>
      </form>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        formData: {
          email: ''
        },
        errors: {},
        loading: false
      }
    },
    methods: {
      async sendResetLink() {
        this.loading = true;
        this.errors = {};

        try {
          const response = await axios.post('/api/forgot-password', this.formData);
          this.$toast.success('Password reset link sent to your email.');
          this.$router.push({ name: 'login' });
        } catch (error) {
          if (error.response?.data?.errors) {
            this.errors = error.response.data.errors;
          } else {
            this.$toast.error('Failed to send reset link. Please try again.');
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
