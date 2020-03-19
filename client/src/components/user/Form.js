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
          htmlFor={`user_${data.input.name}`}
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
          id={`user_${data.input.name}`}
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
          name="firstname"
          type="text"
          placeholder="the firstname of the user."
          required={true}
        />
        <Field
          component={this.renderField}
          name="lastname"
          type="text"
          placeholder="the lastname of the user."
          required={true}
        />
        <Field
          component={this.renderField}
          name="pseudo"
          type="text"
          placeholder="the pseudo of the user."
          required={true}
        />
        <Field
          component={this.renderField}
          name="email"
          type="text"
          placeholder="the email of the user."
          required={true}
        />
        <Field
          component={this.renderField}
          name="password"
          type="text"
          placeholder="the password of the user."
          required={true}
        />
        <Field
          component={this.renderField}
          name="birthDate"
          type="dateTime"
          placeholder="The birthDate of the user."
          required={true}
        />
        <Field
          component={this.renderField}
          name="ratings"
          type="text"
          placeholder="Available rating for this user."
          normalize={v => (v === '' ? [] : v.split(','))}
        />
        <Field
          component={this.renderField}
          name="favorites"
          type="text"
          placeholder="Available favorite for this user."
          normalize={v => (v === '' ? [] : v.split(','))}
        />
        <Field
          component={this.renderField}
          name="comments"
          type="text"
          placeholder="Available comment for this user."
          normalize={v => (v === '' ? [] : v.split(','))}
        />
        <Field
          component={this.renderField}
          name="role"
          type="text"
          placeholder="The Role of the User."
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
  form: 'user',
  enableReinitialize: true,
  keepDirtyOnReinitialize: true
})(Form);
