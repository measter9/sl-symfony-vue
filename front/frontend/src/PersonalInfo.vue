<template>
  <div>
    <h2 class="text-xl font-semibold mb-4">Personal Information</h2>
    <div class="space-y-4">
      <div>
        <label for="firstname" class="block text-sm font-medium text-gray-700">First Name</label>
        <input
          id="firstname"
          v-model="modelValue.firstname"
          type="text"
          required
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
        />
      </div>
      <div>
        <label for="lastname" class="block text-sm font-medium text-gray-700">Last Name</label>
        <input
          id="lastname"
          v-model="modelValue.lastname"
          type="text"
          required
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
        />
      </div>
      <div>
        <label for="birthdate" class="block text-sm font-medium text-gray-700">Birth Date</label>
        <input
          id="birthdate"
          v-model="modelValue.birthdate"
          type="date"
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