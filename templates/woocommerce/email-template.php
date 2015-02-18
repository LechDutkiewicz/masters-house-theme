<div style="background-color:#f2f2f2;font-family:sans-serif;min-height:100%!important;margin:0;padding:0;width:100%!important">
	<table align="center" bgcolor="#f2f2f2" border="0" cellpadding="0" cellspacing="0" width="100% !important" style="border-collapse:collapse!important;background-color:#f2f2f2;font-family:sans-serif;height:100%!important;margin:0;padding:0;width:100%!important">
		<tbody>
			<tr>
				<td align="center" valign="top" style="height:100%!important;margin:0;padding:0;width:100%!important" width="100% !important" height="100% !important">
					<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse!important;width:600px;background-color:#ffffff" width="600" bgcolor="#ffffff">
						<tbody>
							<tr>
								<td align="center" valign="top" style="padding:10px 20px;background-color:#f2f2f2" bgcolor="#f2f2f2">
									<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:separate!important;border-radius:4px;background-color:#ffffff;padding:30px;border:1px solid #ffffff;border-bottom:1px solid #acacac" bgcolor="#ffffff">
										<tbody>
											<tr>
												<td align="center" valign="top">
													<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse!important;width:600px" width="600">
														<tbody>
															<tr>
																<td align="left" valign="top" width="100%" colspan="12" style="color:#444444;font-family:sans-serif;font-size:15px;line-height:150%;text-align:left">
																	<table cellpadding="0" cellspacing="0" border="0" width="100%" style="border-collapse:collapse!important">
																		<tbody>
																			<tr>
																				<td align="left" valign="top" colspan="12" width="100.0%" style="text-align:left;font-family:sans-serif;font-size:15px;line-height:1.5em;color:#444444">
																					<div>
																						<div>
																							<div style="color:inherit;font-size:inherit;line-height:inherit;margin:inherit;padding:inherit">
																								<p style="margin-bottom:1em">
																									<a href="<?php echo get_home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( "name", "display" ) ); ?>">
																										<?php if ( bon_get_option( 'logo_dark' ) ) : ?>
																											<img src = "<?php echo (bon_get_option( 'logo_dark', get_template_directory_uri() . "/assets/images/logo.png" )); ?>" alt = "<?php echo esc_attr( get_bloginfo( "name", "display" ) ); ?>"/>
																										<?php else: ?>
																											<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>
																										<?php endif; ?>
																									</a>
																								</p>
																							</div>
																						</div>
																					</div>
																				</td>
																			</tr>
																		</tbody>
																	</table>
																</td>
															</tr>
															<tr>
																<td align = "left" valign = "top" width = "100%" colspan = "12" style = "color:#444444;font-family:sans-serif;font-size:15px;line-height:150%;text-align:left">
																	<table cellpadding = "0" cellspacing = "0" border = "0" width = "100%" style = "border-collapse:collapse!important">
																		<tbody>
																			<tr>
																				<td align = "left" valign = "top" colspan = "12" width = "100.0%" style = "text-align:left;font-family:sans-serif;font-size:15px;line-height:1.5em;color:#444444">
																					<div>
																						<div style = "color:inherit;font-size:inherit;line-height:inherit;margin:inherit;padding:inherit">
																							<p style = "margin-bottom:1em" >Hi&nbsp;' . $name . ',</p>
																							<p style = "margin-bottom:1em"><?php echo __( "Thank you for downloading our ebook.", "bon" ) . ' ' . $subject; ?></p>
																							<p style = "margin-bottom:1em"><?php echo __( "You can download it here", "bon" ); ?>-&nbsp;<a href = "<?php echo $link; ?>" target = "_blank"><?php echo $anchor; ?></a></p>
																							<p style = "margin-bottom:1em"><?php echo __( "We hope you find this helpful!", "bon" ); ?></p>
																							<p style = "margin-bottom:1em;">
																								<a style = "display:inline-block;padding-top:0.86667em;padding-right:1.2em;padding-bottom:0.86667em;padding-left:1.2em;font-size:1.06667em;background-color: #27AE60;border-color: #0E9547;border-radius:5px;border-style:solid;border-width:0 0 5px;color:#FFF;text-decoration:none" href = "<?php echo $link; ?>"><?php echo $anchor; ?></a>
																							</p>
																							<p style = "margin-bottom:1em"><?php echo __( "All the best", "bon" ) . ', <br>' . esc_attr( get_bloginfo( 'name' ) ); ?></p>
																						</div>
																					</div>
																				</td>
																			</tr>
																		</tbody>
																	</table>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</div>