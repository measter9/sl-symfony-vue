<template>
  <div>
    <h2 class="text-xl font-semibold mb-4">Contact Information</h2>
    <div class="space-y-4">
      <div>
        <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
        <input
          id="phone"
          v-model="modelValue.phone"
          type="tel"
          required
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
        />
      </div>
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input
          id="email"
          v-model="modelValue.email"
          type="email"
          required
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
        />
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue'

defineProps(['modelValue'])
</script>