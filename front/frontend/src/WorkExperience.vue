<template>
  <div>
    <h2 class="text-xl font-semibold mb-4">Work Experience</h2>
    <div v-for="(exp, index) in modelValue" :key="index" class="mb-6 p-4 border rounded-lg">
      <h3 class="text-lg font-medium mb-2">Experience {{ index + 1 }}</h3>
      <div class="space-y-4">
        <div>
          <label :for="'position-' + index" class="block text-sm font-medium text-gray-700">Position</label>
          <input
            :id="'position-' + index"
            v-model="exp.position"
            type="text"
            required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
          />
        </div>
        <div>
          <label :for="'company-' + index" class="block text-sm font-medium text-gray-700">Company</label>
          <input
            :id="'company-' + index"
            v-model="exp.company"
            type="text"
            required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
          />
        </div>
        <div>
          <label :for="'startDate-' + index" class="block text-sm font-medium text-gray-700">Start Date</label>
          <input
            :id="'startDate-' + index"
            v-model="exp.startDate"
            type="date"
            required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
          />
        </div>
        <div>
          <label :for="'endDate-' + index" class="block text-sm font-medium text-gray-700">End Date</label>
          <input
            :id="'endDate-' + index"
            v-model="exp.endDate"
            type="date"
            required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
          />
        </div>
      </div>
      <button
        @click="removeExperience(index)"
        type="button"
        class="mt-2 px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500"
      >
        Remove
      </button>
    </div>
    <button
      @click="addExperience"
      type="button"
      class="mt-4 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500"
    >
      Add Experience
    </button>
  </div>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue'

const props = defineProps(['modelValue'])
const emit = defineEmits(['update:modelValue'])

const addExperience = () => {
  const newExperience = {
    position: '',
    company: '',
    startDate: '',
    endDate: ''
  }
  emit('update:modelValue', [...props.modelValue, newExperience])
}

const removeExperience = (index) => {
  const updatedExperience = props.modelValue.filter((_, i) => i !== index)
  emit('update:modelValue', updatedExperience)
}
</script>