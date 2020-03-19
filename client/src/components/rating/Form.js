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
          htmlFor={`rating_${data.input.name}`}
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
          id={`rating_${data.input.name}`}
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
          name="user"
          type="text"
          placeholder="The User of the Rating."
          required={true}
        />
        <Field
          component={this.renderField}
          name="artwork"
          type="text"
          placeholder="The Artwork of the Rating."
          required={true}
        />
        <Field
          component={this.renderField}
          name="grade"
          type="number"
          placeholder="The rating of the Artwork by an User (between 1 and 5)."
          normalize={v => parseFloat(v)}
        />
        <Field
          component={this.renderField}
          name="ratingDate"
          type="dateTime"
          placeholder="The date of the rating."
          required={true}
        />

        <button type="submit" className="btn btn-success">
          Submit
        </button>
      </form>
    );
  }
}

export default reduxForm({
  form: 'rating',
  enableReinitialize: true,
  keepDirtyOnReinitialize: true
})(Form);
