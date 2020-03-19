import React, { Component } from 'react';
import { Field, reduxForm } from 'redux-form';
import PropTypes from 'prop-types';

class Form extends Component {
  static propTypes = {
    handleSubmit: PropTypes.func.isRequired,
    error: PropTypes.string
  };

  renderField = data => {
    data.input.className = 'form-control';

    const isInvalid = data.meta.touched && !!data.meta.error;
    if (isInvalid) {
      data.input.className += ' is-invalid';
      data.input['aria-invalid'] = true;
    }

    if (this.props.error && data.meta.touched && !data.meta.error) {
      data.input.className += ' is-valid';
    }

    return (
      <div className={`form-group`}>
        <label
          htmlFor={`artwork_${data.input.name}`}
          className="form-control-label"
        >
          {data.input.name}
        </label>
        <input
          {...data.input}
          type={data.type}
          step={data.step}
          required={data.required}
          placeholder={data.placeholder}
          id={`artwork_${data.input.name}`}
        />
        {isInvalid && <div className="invalid-feedback">{data.meta.error}</div>}
      </div>
    );
  };

  render() {
    return (
      <form onSubmit={this.props.handleSubmit}>
        <Field
          component={this.renderField}
          name="description"
          type="text"
          placeholder="The description of this Artwork."
          required={true}
        />
        <Field
          component={this.renderField}
          name="publicationDate"
          type="dateTime"
          placeholder="The publication date of this Artwork."
          required={true}
        />
        <Field
          component={this.renderField}
          name="image"
          type="text"
          placeholder="The image path of this Artwork."
          required={true}
        />
        <Field
          component={this.renderField}
          name="locals"
          type="text"
          placeholder="Available local for this Artwork."
          normalize={v => (v === '' ? [] : v.split(','))}
        />
        <Field
          component={this.renderField}
          name="tags"
          type="text"
          placeholder="Tags of the Artwork"
          required={true}
        />
        <Field
          component={this.renderField}
          name="category"
          type="text"
          placeholder="The Category of the Artwork."
          required={true}
        />
        <Field
          component={this.renderField}
          name="authors"
          type="text"
          placeholder="Authors of the Artwork"
          required={true}
          normalize={v => (v === '' ? [] : v.split(','))}
        />
        <Field
          component={this.renderField}
          name="ratings"
          type="text"
          placeholder="Available rating for this artwork."
          normalize={v => (v === '' ? [] : v.split(','))}
        />
        <Field
          component={this.renderField}
          name="favorites"
          type="text"
          placeholder="Available favorite for this artwork."
          normalize={v => (v === '' ? [] : v.split(','))}
        />
        <Field
          component={this.renderField}
          name="comments"
          type="text"
          placeholder="Available comment for this artwork."
          normalize={v => (v === '' ? [] : v.split(','))}
        />

        <button type="submit" className="btn btn-success">
          Submit
        </button>
      </form>
    );
  }
}

export default reduxForm({
  form: 'artwork',
  enableReinitialize: true,
  keepDirtyOnReinitialize: true
})(Form);
