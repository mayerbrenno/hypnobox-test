<!-- resources/js/components/crud/ItemEdit.vue -->
<template>
    <div class="item-edit">
      <h2>Edit Item</h2>
      <form @submit.prevent="updateItem" class="form">
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
          <label for="description">Description</label>
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
            <span v-if="loading">Updating...</span>
            <span v-else>Update</span>
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
    mounted() {
      this.loadItem();
    },
    methods: {
      async loadItem() {
        this.loading = true;
        this.errors = {};

        try {
          const response = await axios.get(`/api/items/${this.$route.params.id}`);
          this.formData = response.data;
        } catch (error) {
          this.$toast.error('Failed to load item');
          this.$router.push({ name: 'items-list' });
        } finally {
          this.loading = false;
        }
      },
      async updateItem() {
        this.loading = true;
        this.errors = {};

        try {
          const response = await axios.put(
            `/api/items/${this.$route.params.id}`,
            this.formData
          );
          this.$router.push({ name: 'items-list' });
        } catch (error) {
          if (error.response?.data?.errors) {
            this.errors = error.response.data.errors;
          } else {
            this.$toast.error('Failed to update item');
          }
        } finally {
          this.loading = false;
        }
      }
    }
  }
  </script>

  <style scoped>
  /* Same styles as ItemCreate.vue */
  </style>
