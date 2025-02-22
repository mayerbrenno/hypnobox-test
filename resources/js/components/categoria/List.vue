<template>
    <div class="items-container">
      <div class="header">
        <h2>Items List</h2>
        <router-link
          :to="{ name: 'items-create' }"
          class="btn btn-primary"
        >
          Add New Item
        </router-link>
      </div>

      <div v-if="loading" class="loading">
        <div class="spinner-border spinner-border-lg"></div>
      </div>

      <div v-if="error" class="alert alert-danger">
        {{ error }}
      </div>

      <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in items" :key="item.id">
            <td>{{ item.id }}</td>
            <td>{{ item.name }}</td>
            <td>{{ item.description }}</td>
            <td>
              <router-link
                :to="{ name: 'items-edit', params: { id: item.id } }"
                class="btn btn-sm btn-primary"
              >
                Edit
              </router-link>
              <button
                @click="deleteItem(item.id)"
                class="btn btn-sm btn-danger"
                :disabled="deleting === item.id"
              >
                <span v-if="deleting === item.id">Deleting...</span>
                <span v-else>Delete</span>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        items: [],
        loading: false,
        error: null,
        deleting: null
      }
    },
    mounted() {
      this.loadItems();
    },
    methods: {
      async loadItems() {
        this.loading = true;
        this.error = null;

        try {
          const response = await axios.get('/api/items');
          this.items = response.data;
        } catch (error) {
          this.error = error.response?.data?.message || 'Failed to load items';
        } finally {
          this.loading = false;
        }
      },
      async deleteItem(id) {
        this.deleting = id;
        try {
          await axios.delete(`/api/items/${id}`);
          this.items = this.items.filter(item => item.id !== id);
        } catch (error) {
          this.error = error.response?.data?.message || 'Failed to delete item';
        } finally {
          this.deleting = null;
        }
      }
    }
  }
  </script>

  <style scoped>
  .items-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
  }

  .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
  }

  .loading {
    display: flex;
    justify-content: center;
    margin: 20px 0;
  }

  .alert {
    margin: 10px 0;
    padding: 10px;
    border-radius: 4px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
  }

  th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }

  th {
    background-color: #f8f9fa;
  }

  .btn {
    margin: 0 5px;
  }

  .btn-primary {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
  }

  .btn-danger {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
  }

  .btn-sm {
    padding: 6px 12px;
    font-size: 0.875rem;
  }

  .btn:disabled {
    opacity: 0.65;
    cursor: not-allowed;
  }
  </style>
