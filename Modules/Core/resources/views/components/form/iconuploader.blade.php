<div class="conca-icon-uploader">
  <label for="iconType">Select Icon Type:</label>
  <select id="iconType" name="iconType">
      <option value="">-- Select Icon Type --</option>
      <option value="image">Image</option>
      <option value="icon">Icon Class</option>
      <option value="svg">SVG Code</option>
  </select>

  <!-- Image Upload Field -->
  <div data-type="image" class="icon-upload-field">
      <label for="imageUpload">Upload Image:</label>
      <input type="file" id="imageUpload" name="imageUpload" accept="image/*" />
  </div>

  <!-- Icon Class Field -->
  <div data-type="icon"" class="icon-upload-field">
      <label for="iconClass">Icon Class:</label>
      <input type="text" id="iconClass" name="iconClass" placeholder="e.g., fas fa-user" />
  </div>

  <!-- SVG Code Field -->
  <div data-type="svg" class="icon-upload-field">
      <label for="svgCode">SVG Code:</label>
      <textarea id="svgCode" name="svgCode" rows="4" placeholder="Paste your SVG code here..."></textarea>
  </div>
</div>
