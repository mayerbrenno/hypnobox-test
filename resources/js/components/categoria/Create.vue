<template>
    <div class="item-create">
      <h2>Criar nova Categoria</h2>
      <form @submit.prevent="createCategoria" class="form">
        <div class="form-group">
          <label for="name">Name</label>
          <input
            type="text"
            id="name"
            v-model="formData.name"
            required
            :class="{ 'error': errors.name }"
          >
          <div class="error-message" v-if="errors.name">{{ errors.name }}</div>
        </div>

        <div class="form-group">
          <label for="active">Active</label>
          <textarea
            id="description"
            v-model="formData.description"
            required
            :class="{ 'error': errors.description }"
          ></textarea>
          <div class="error-message" v-if="errors.description">{{ errors.description }}</div>
        </div>

        <div class="form-actions">
          <router-link
            :to="{ name: 'items-list' }"
            class="btn btn-secondary"
          >
            Cancel
          </router-link>
          <button
            type="submit"
            class="btn btn-primary"
            :disabled="loading"
          >
            <span v-if="loading">Creating...</span>
            <span v-else>Create</span>
          </button>
        </div>
      </form>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        formData: {
          name: '',
          description: ''
        },
        errors: {},
        loading: false
      }
    },
    methods: {
      async createCategoria() {
        this.loading = true;
        this.errors = {};

        try {
          const response = await axios.post('/api/categorias', this.formData);
          this.$router.push({ name: 'categoria-list' });
        } catch (error) {
          if (error.response?.data?.errors) {
            this.errors = error.response.data.errors;
          } else {
            this.$toast.error('Failed to create item');
          }
        } finally {
          this.loading = false;
        }
      }
    }
  }
  </script>

  <style scoped>
  .item-create {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
  }

  .form {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .form-group input,
  .form-group textarea {
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
  }

  .form-group textarea {
    min-height: 120px;
    resize: vertical;
  }

  .error {
    border-color: #dc3545;
  }

  .error-message {
    color: #dc3545;
    font-size: 0.875rem;
  }

  .form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 20px;
  }

  .btn {
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
  }

  .btn-primary {
    background-color: #007bff;
    color: white;
    border: none;
  }

  .btn-secondary {
    background-color: #6c757d;
    color: white;
    border: none;
  }

  .btn:disabled {
    opacity: 0.65;
    cursor: not-allowed;
  }
  </style>
