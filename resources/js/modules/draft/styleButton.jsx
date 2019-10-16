import PropTypes from 'prop-types';
import React from 'react';

export default class StyleButton extends React.Component {

  constructor() {
    super();
    this.onToggle = (e) => {
      e.preventDefault();
      this.props.onToggle(this.props.style);
    };
  }

  static propTypes = {
    active: PropTypes.bool,
    label: PropTypes.string,
    onToggle: PropTypes.func,
    style: PropTypes.string
  }

  render() {
    let className = 'RichEditor-styleButton';

    if (this.props.active) {
      className += ' RichEditor-activeButton';
    }

    return (
      <span className={className} onMouseDown={this.onToggle}>
        {this.props.label}
      </span>
    );
  }

}